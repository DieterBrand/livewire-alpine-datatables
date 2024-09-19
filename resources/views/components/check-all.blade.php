<input x-data="checkAll" x-ref="checkAllCheckbox" @change="handleChange" type="checkbox"
    class="rounded border-gray-300 shadow">

@script
    <script>
        Alpine.data('checkAll', () => {
            return {
                init() {
                    this.$wire.watch('selectedStudentIds', () => {
                            this.updateCheckAllState()
                        }),
                        this.$wire.watch('studentIdsOnPage', () => {
                            this.updateCheckAllState()
                        })
                },
                pageIsSelected() {
                    return this.$wire.studentIdsOnPage.every(id => this.$wire.selectedStudentIds.includes(
                        id));
                },
                pageIsEmpty() {
                    return this.$wire.selectedStudentIds.length === 0;
                },
                handleChange(e) {
                    e.target.checked ? this.selectAll() : this.deselectAll()
                },
                selectAll() {
                    this.$wire.studentIdsOnPage.forEach(id => {
                        if (this.$wire.selectedStudentIds.includes(id)) return;
                        this.$wire.selectedStudentIds.push(id);
                    });
                },
                deselectAll() {
                    this.$wire.selectedStudentIds = []
                },
                updateCheckAllState() {
                    if (this.pageIsSelected()) {
                        this.$refs.checkAllCheckbox.indeterminate = false;
                        this.$refs.checkAllCheckbox.checked = true;
                    } else if (this.pageIsEmpty()) {
                        this.$refs.checkAllCheckbox.checked = false;
                        this.$refs.checkAllCheckbox.indeterminate = false;
                    } else {
                        this.$refs.checkAllCheckbox.indeterminate = true;
                    }
                }
            }
        })
    </script>
@endscript
