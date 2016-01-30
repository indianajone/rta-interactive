<search inline-template>
    <div class="search navbar-right">
        <input type="text" class="form-control" placeholder="SmartSearch"
            @blur="reset | debounce 500"
            v-model="query"
            @keyup="search | debounce 300"
        >
        <i class="fa fa-search"></i>
        <div class="search__results">
            <small class="search__item text-center" v-if="noResults">no results</small>
            <div class="search__item" v-for="item in results.recommended" v-if="noResults">
                <div class="search__left">
                    <small class="label label-primary">แนะนำ</small>
                    <img class="search__image" :src="item.thumbnail" alt="@{{ item.name }}">
                </div>
                <div class="search__right">
                    <a href="@{{ item.rel }}">
                        <h5 class="search__heading">
                            @{{{ item.name | highlight }}} 
                        </h5>
                    </a>
                    <p class="search__body">@{{{ item.excerpt | highlight }}}</p>
                </div>
                <a href="@{{ item.map }}"><i class="fa fa-lg fa-car"></i></a>
            </div>
            <div class="search__item" v-for="item in results.search | limitBy 5">
                <div class="search__left">
                    <small v-if="item.recommended" class="label label-primary">แนะนำ</small>
                    <img class="search__image" :src="item.thumbnail" alt="@{{ item.name }}">
                </div>
                <div class="search__right">
                    <a href="@{{ item.rel }}">
                        <h5 class="search__heading">
                            @{{{ item.name | highlight }}} 
                        </h5>
                    </a>
                    <p class="search__body">@{{{ item.excerpt | highlight }}}</p>
                </div>
                <a href="@{{ item.map }}"><i class="fa fa-lg fa-car"></i></a>
            </div>
        </div>
    </div>
</search>