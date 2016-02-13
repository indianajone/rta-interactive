<search inline-template locale="{{ App::getLocale() }}">
    <div class="search">
        <input type="text" class="form-control" placeholder="SmartSearch"
            @_blur="reset | debounce 500"
            v-model="query"
            @keyup="search | debounce 300"
        >
        <div class="search__results" v-cloak>
            <div class="search__item text-center" v-if="noResults">
                <small>{{ trans('common.notfound') }}</small>
            </div>
            <div class="search__item" v-for="item in results.recommended" v-if="noResults">
                <div class="search__image">
                    <small class="label label-primary">แนะนำ</small>
                    <img :src="item.thumbnail" alt="@{{ item.name }}">
                </div>
                <div class="search__title">
                    <a href="@{{ item.rel }}">
                        <h5 class="search__heading">
                            @{{{ item.name | highlight }}} 
                        </h5>
                    </a>
                    <p class="search__body">@{{{ item.excerpt | highlight }}}</p>
                </div>
                <div class="search__links">
                    <a href="@{{ item.map }}"><i class="fa fa-lg fa-car"></i></a>
                </div>
            </div>
            <div class="search__item" v-for="item in results.search | limitBy 5">
                <div class="search__image">
                    <small v-if="item.recommended" class="label label-primary">แนะนำ</small>
                    <img :src="item.thumbnail" alt="@{{ item.name }}">
                </div>
                <div class="search__title">
                    <a href="@{{ item.rel }}">
                        <h5 class="search__heading">
                            @{{{ item.name | highlight }}} 
                        </h5>
                    </a>
                    <p class="search__body">@{{{ item.excerpt | highlight }}}</p>
                </div>
                <div class="search__links">
                    <a href="@{{ item.map }}"><i class="fa fa-lg fa-car"></i></a>
                </div>
            </div>
        </div>
    </div>
</search>