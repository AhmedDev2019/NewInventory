<div class="products_body">
    <ul class="products-list">
        @if( $products->count() > 0 )
            @foreach($products as $product)
                <li>
                    <img src="{{ asset($product->image) }}" alt="">
                    <h4>
                        @if( app()->getLocale() == 'ar' )
                            {{ $product->name_ar }}
                        @elseif( app()->getLocale() == 'en' )
                            {{ $product->name_en }}
                        @endif
                    </h4>
                </li>
            @endforeach
        @else
            <li>
                <img src="{{ asset('uploads/products/default.png') }}" alt="">
                <h4>{{ trans('backend.no_data') }}</h4>
            </li>
        @endif
    </ul>
</div>