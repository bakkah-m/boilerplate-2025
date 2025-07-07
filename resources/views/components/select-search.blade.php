<div class="w-full relative" 
     x-data="searchDropdown({{ json_encode($preselectedValue ?? '') }})" 
     @click.away="close()" 
     @keydown.arrow-down.prevent="next()" 
     @keydown.arrow-up.prevent="prev()" 
     @keydown.enter.prevent="selectActive()">

    <input type="text" class="input w-full" placeholder="Cari..." 
           x-model="search" 
           @focus="open()" 
           @input="filter()" />

    <div class="w-full bg-base-100 overflow-y-scroll max-h-40 absolute z-[9999] border-2 border-t-none" 
         x-show="show" 
         x-transition>
        <template x-for="(option, index) in filteredOptions" :key="option.id">
            <p class="text-base p-2 hover:bg-base-200 cursor-pointer"
               :class="{ 'bg-base-300': index === activeIndex }"
               @click="choose(option)">
                <span x-text="option.label"></span>
            </p>
        </template>
    </div>

    <input type="hidden" name="{{ $name }}" x-model="selectedValue" />
</div>

<script>
function searchDropdown(preselectedId) {
    return {
        search: '',
        show: false,
        activeIndex: -1,
        selectedValue: '',
        options: [
            @foreach ($options as $o)
                {
                    id: '{{ $o->$value }}',
                    label: `@foreach (array_values($label) as $a){{ $o->$a }} @endforeach`
                },
            @endforeach
        ],
        filteredOptions: [],

        init() {
            // Handle preselected value on init
            if (preselectedId) {
                const match = this.options.find(opt => opt.id == preselectedId);
                if (match) {
                    this.search = match.label.trim();
                    this.selectedValue = match.id;
                }
            }
            this.filter();
        },

        open() {
            this.show = true;
            this.filter();
        },

        close() {
            this.show = false;
            this.activeIndex = -1;
        },

        filter() {
            const term = this.search.toLowerCase();
            this.filteredOptions = this.options.filter(opt => opt.label.toLowerCase().includes(term));
            this.activeIndex = -1;
        },

        next() {
            if (this.filteredOptions.length === 0) return;
            this.activeIndex = (this.activeIndex + 1) % this.filteredOptions.length;
            this.scrollToActive();
        },

        prev() {
            if (this.filteredOptions.length === 0) return;
            this.activeIndex = (this.activeIndex - 1 + this.filteredOptions.length) % this.filteredOptions.length;
            this.scrollToActive();
        },

        scrollToActive() {
            this.$nextTick(() => {
                const list = this.$el.querySelectorAll('p');
                if (list[this.activeIndex]) {
                    list[this.activeIndex].scrollIntoView({ block: 'nearest' });
                }
            });
        },

        selectActive() {
            if (this.activeIndex >= 0) {
                this.choose(this.filteredOptions[this.activeIndex]);
            }
        },

        choose(option) {
            this.search = option.label.trim();
            this.selectedValue = option.id;
            this.close();
        }
    }
}
</script>
