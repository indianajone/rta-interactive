<destinations inline-template
    @change="navigateMe"
    :selected.sync="route.destination",
    :categories="{{ $categories }}"
    :places="{{ $nearby }}"
>
    <div class="input-group">
        <div class="input-group-btn">
            <button data-toggle="dropdown" class="btn btn-main dropdown">
                <i class="fa fa-sliders"></i>
            </button>
            <ul class="dropdown-menu">
                <li v-for="(name, children) in categories">
                    <div class="col-xs-12">
                        <div class="checkbox">
                            <label class="text-muted">
                                <input 
                                    v-model="filteredBy"
                                    type="checkbox" 
                                    :value="children"
                                >
                                @{{ name }}
                            </label>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <select 
            v-dropdown-checkbox
            v-model="selected"
            v-el:destination
            type="text" 
            class="form-control" 
            required
        >
            <option value=''>{{ trans('map.destination') }}</option>
            <option 
                v-for="place in destinations | inCategory" 
                v-bind:value="place.location"
            >
                @{{ place.title }}
            </option>
        </select>
    </div>
</destinations>