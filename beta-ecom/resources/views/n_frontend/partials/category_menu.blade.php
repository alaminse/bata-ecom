<div class="ltn__category-menu-wrap">
    <div class="ltn__category-menu-title">
        <h2 class="section-bg-1 ltn__secondary-bg text-color-white">{{ translate('Categories') }}</h2>
    </div>
    <div class="ltn__category-menu-toggle ltn__one-line-active">
        <ul>
            <!-- Submenu Column - 4 -->
            @foreach(\App\Category::where('level', 0)->orderBy('order_level', 'desc')->get()->take(8) as $key => $category)
                <li class="ltn__category-menu-item ltn__category-menu-drop" data-id="{{ $category->id }}">
                <a href="{{ route('products.category', $category->slug) }}">
                    <img
                        class="cat-image lazyload mr-2"
                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ uploaded_asset($category->icon) }}"
                        width="20"
                        alt="{{ $category->getTranslation('name') }}"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                    >
                    {{ $category->getTranslation('name') }} </a>
                @if(count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id))>0)
                <ul class="ltn__category-submenu ltn__category-column-4">
                    @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category->id) as $key => $first_level_id)
                    <li class="ltn__category-submenu-title ltn__category-menu-drop"><a href="{{ route('products.category', \App\Category::find($first_level_id)->slug) }}">{{ \App\Category::find($first_level_id)->getTranslation('name') }}</a>
                        <ul class="ltn__category-submenu-children">
                            @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($first_level_id) as $key => $second_level_id)
                            <li>
                                <a href="{{ route('products.category', \App\Category::find($second_level_id)->slug) }}">{{ \App\Category::find($second_level_id)->getTranslation('name') }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach

                </ul>
                @endif
            </li>
            @endforeach
            <li class="ltn__category-menu-more-item-parent">
                <a class="" href="{{ route('categories.all') }}">
                    {{translate('See All')}} <span class="fas fa-arrow-alt-circle-right"></span>
                </a>
            </li>
        </ul>
    </div>
</div>