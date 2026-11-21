<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookOrder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookOrderController extends Controller
{
    public function index(): View
    {
        return view('admin.orders.index', [
            'orders' => BookOrder::query()->with('book')->latest()->paginate(15),
        ]);
    }

    public function show(BookOrder $order): View
    {
        $order->load('book');

        return view('admin.orders.show', ['order' => $order]);
    }

    public function update(Request $request, BookOrder $order): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', 'in:new,processing,completed,cancelled'],
        ]);

        $order->update($data);

        return back()->with('success', 'Order status updated.');
    }

    public function destroy(BookOrder $order): RedirectResponse
    {
        $order->delete();

        return redirect()->route('admin.orders.index')->with('success', 'Order deleted.');
    }
}
