<div x-data="checkAllButton">
    <button @click="selectAll"
        class="flex items-center gap-2 rounded-lg border px-3 py-1.5 bg-white font-medium text-md text-gray-700 hover:bg-gray-200 disabled:cursor-not-allowed disabled:opacity-75"
        :class="allSelected && 'ring-2 ring-inset ring-gray-600'">
        <x-icons.checked x-show="allSelected" />
        <span x-text="allSelected ? 'All Selected' : 'Select All?'"></span>
    </button>
</div>

@script
    <script>
        Alpine.data('checkAllButton', () => {
            return {
                allSelected: false,
                selectAll() {
                    if (this.$wire.selectedStudentIds == this.$wire.allStudentIds) {
                        this.deSelectAll();
                        return;
                    }
                    this.$wire.selectedStudentIds = this.$wire.allStudentIds;
                    this.allSelected = true;
                },
                deSelectAll() {
                    this.$wire.selectedStudentIds = [];
                    this.allSelected = false;
                }
            }
        })
    </script>
@endscript
