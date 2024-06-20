@extends('layouts.main')
@section('title', 'Cart')
@section('content')

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center py-6">
            @php
                $cartItemsCount = Cart::instance('default')->count();
            @endphp

            @if ($cartItemsCount > 0)
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ $cartItemsCount }} items in the shopping cart
                </h3>

                <div class="hidden md:block">
                    <div class="ml-4 flex-shrink-0">
                        <a href="{{ route('shop.index') }}"
                            class="inline-flex items-baseline px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            @else
                <div class="alert alert-info">
                    <h4 class="lead">
                        No items in the cart. <a class="btn custom-border-n" href="{{ route('shop.index') }}">Continue
                            shopping</a>
                    </h4>
                </div>
            @endif
        </div>

        <div class="border-t border-gray-200">
            <dl class="sm:divide-y sm:divide-gray-200">
                @forelse (Cart::instance('default')->content() as $item)
                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                        <dt class="text-sm font-medium text-gray-500">
                            <a href="{{ route('shop.show', $item->model->slug) }}">
                                <img src="{{ productImage($item->model->image) }}" class="rounded-lg" height="100px"
                                    width="100px" alt="{{ $item->model->name }}">
                            </a>
                        </dt>

                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <a href="{{ route('shop.show', $item->model->slug) }}" class="text-blue-600 hover:underline">
                                <h3 class="font-semibold">{{ $item->model->name }}</h3>
                                <p class="text-gray-500">{{ $item->model->details }}</p>
                            </a>
                        </dd>
                    </div>

                    <div class="sm:hidden border-b border-gray-200 py-4">
                        <dl class="sm:hidden">
                            <dt class="order-2 pt-1 text-sm font-medium text-gray-500">
                                <span class="text-gray-900">{{ $item->model->name }}</span>
                            </dt>
                            <dd class="order-1 text-sm text-gray-500">
                                <span class="text-gray-900">{{ $item->model->details }}</span>
                            </dd>
                        </dl>
                    </div>

                    <div class="sm:col-span-2">
                        <div class="flex items-center">

                            <div class="flex-shrink-0">
                                <select class='quantity form-select block w-full mt-1' data-id='{{ $item->rowId }}'
                                    data-productQuantity='{{ $item->model->quantity }}'>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option class="option" value="{{ $i }}"
                                            {{ $item->qty == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="ml-4 flex-shrink-0">
                                <button type="button"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                    onclick="document.getElementById('delete-item').submit();">
                                    Remove
                                </button>
                            </div>

                            <div class="ml-4 flex-shrink-0">
                                <button type="button"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                    onclick="document.getElementById('save-later').submit();">
                                    Save for Later
                                </button>
                            </div>

                        </div>
                    </div>

                    <div class="sm:col-span-1">
                        <div class="text-sm font-medium text-gray-900">
                            ${{ format($item->subtotal) }}
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500">No items in your cart.</p>
                @endforelse
            </dl>
        </div>

        <!-- Summary Section -->
        <div class="pt-8 pb-12 border-t border-gray-200">
            <dl class="sm:divide-y sm:divide-gray-200">
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Subtotal
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        ${{ format(Cart::subtotal()) }}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tax (21%)
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        ${{ format(Cart::tax()) }}
                    </dd>
                </div>
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Total
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        ${{ format(Cart::total()) }}
                    </dd>
                </div>
            </dl>
        </div>

        <div class="pt-8 pb-12 border-t border-gray-200">
            <dl class="sm:divide-y sm:divide-gray-200">
                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Subtotal
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        ${{ format(Cart::subtotal()) }}
                    </dd>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Tax (21%)
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        ${{ format(Cart::tax()) }}
                    </dd>
                </div>

                <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm font-medium text-gray-500">
                        Total
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        ${{ format(Cart::total()) }}
                    </dd>
                </div>
            </dl>
        </div>

        <!-- End of Summary Section -->
        <!-- Saved for Later Items -->
        @if (Cart::instance('saveForLater')->count() > 0)
            <div class="pt-8 pb-12 border-t border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ Cart::instance('saveForLater')->count() }} items saved for later
                </h3>
                <dl class="sm:divide-y sm:divide-gray-200">
                    @forelse (Cart::instance('saveForLater')->content() as $item)
                        <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">
                                <a href="{{ route('shop.show', $item->model->slug) }}">
                                    <img src="{{ productImage($item->model->image) }}" class="rounded-lg" height="100px"
                                        width="100px" alt="{{ $item->model->name }}">
                                </a>
                            </dt>

                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                <a href="{{ route('shop.show', $item->model->slug) }}"
                                    class="text-blue-600 hover:underline">
                                    <h3 class="font-semibold">{{ $item->model->name }}</h3>
                                    <p class="text-gray-500">{{ $item->model->details }}</p>
                                </a>
                            </dd>
                        </div>
                    @empty
                        <p class="text-center text-gray-500">No items saved for later.</p>
                    @endforelse
                </dl>
            </div>
        @endif

    </div>

    @include('partials.product.might-like')
    <!-- end page content -->

@endsection

@section('scripts')

    <script type="text/javascript">
        $(document).ready(function() {
            $('.quantity').on('change', function() {
                const id = this.getAttribute('data-id')
                console.log(id)
                const productQuantity = this.getAttribute('data-productQuantity')
                axios.patch('/cart/' + id, {
                        quantity: this.value,
                        productQuantity: productQuantity
                    })
                    .then(response => {
                        console.log(response)
                        window.location.href = '{{ route('cart.index') }}'
                    }).catch(error => {
                        window.location.href = '{{ route('cart.index') }}'
                    })
            });
        });
    </script>

@endsection
