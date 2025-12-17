{{-- LEFT FILTERS --}}
<aside class="filters">
    <h3>Filters</h3>

    <div class="filter-group">
        <h4>Price</h4>
        <ul>
            <li>
                <a href="{{ route('products.index', array_merge(request()->query(), ['min' => 0, 'max' => 10])) }}"
                   class="{{ (request()->query('min') == 0 && request()->query('max') == 10) ? 'active' : '' }}">
                    £0 - £10
                </a>
            </li>
            <li>
                <a href="{{ route('products.index', array_merge(request()->query(), ['min' => 10, 'max' => 25])) }}"
                   class="{{ (request()->query('min') == 10 && request()->query('max') == 25) ? 'active' : '' }}">
                    £10 - £25
                </a>
            </li>
            <li>
                <a href="{{ route('products.index', array_merge(request()->query(), ['min' => 25, 'max' => 50])) }}"
                   class="{{ (request()->query('min') == 25 && request()->query('max') == 50) ? 'active' : '' }}">
                    £25 - £50
                </a>
            </li>
            <li>
                <a href="{{ route('products.index', array_merge(request()->query(), ['min' => 50, 'max' => 100])) }}"
                   class="{{ (request()->query('min') == 50 && request()->query('max') == 100) ? 'active' : '' }}">
                    £50 - £100
                </a>
            </li>
            <li>
                <a href="{{ route('products.index', array_merge(request()->query(), ['min' => 100, 'max' => 1000])) }}"
                   class="{{ (request()->query('min') == 100 && request()->query('max') == 1000) ? 'active' : '' }}">
                    £100+
                </a>
            </li>
        </ul>
    </div>

    <div class="filter-group">
        <h4>Categories</h4>

        <form method="GET" action="{{ route('products.index') }}" id="category-filters">

            {{-- Preserve price filters --}}
            @if(request()->has('min'))
                <input type="hidden" name="min" value="{{ request()->query('min') }}">
            @endif

            @if(request()->has('max'))
                <input type="hidden" name="max" value="{{ request()->query('max') }}">
            @endif

            @foreach($categories as $cat)
                @php
                    $selected = is_array(request()->query('category'))
                        ? in_array($cat->ProductCategory_ID, request()->query('category'))
                        : ((string)request()->query('category') === (string)$cat->ProductCategory_ID);
                @endphp

                <div class="cat-checkbox">
                    <label>
                        <input type="checkbox"
                               name="category[]"
                               value="{{ $cat->ProductCategory_ID }}"
                               {{ $selected ? 'checked' : '' }}>
                        {{ $cat->Name }}
                    </label>
                </div>
            @endforeach

            <div style="margin-top:8px;">
                <button type="submit" class="apply-filters">Apply</button>
                <a href="{{ route('products.index') }}" class="clear-filters">Clear</a>
            </div>
        </form>
    </div>
</aside>
