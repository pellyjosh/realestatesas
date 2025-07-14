<!-- Dynamic Confirmation Modal -->
<div x-data="{
    isOpen: false,
    modalAction: null,
    init() {
        this.$watch('$store.modal.currentModal', (newModal) => {
            this.isOpen = newModal === 'confirm-action-modal';
            if (this.isOpen) {
                this.modalAction = this.$store.modal.action; // Use action directly from the store
                this.$nextTick(() => {
                    this.$refs.modalContent.querySelector('button')?.focus();
                });
            }
        });
        this.$el.addEventListener('open-modal', (event) => {
            if (event.detail === 'confirm-action-modal') {
                this.$store.modal.currentModal = 'confirm-action-modal';
                // No need to set action here, it's set by the component dispatching open-modal
            }
        });
        this.$el.addEventListener('close-modal', () => {
            this.$store.modal.currentModal = null;
            this.$store.modal.action = null; // Reset action on close
        });
    }
}" x-show="isOpen" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
    <div x-ref="modalContent" class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4 p-6">
        <h2 class="text-lg font-medium text-gray-900"
            x-text="modalAction === 'deactivate' ? 'Are you sure you want to deactivate this link?' : 'Are you sure you want to delete this link?'">
        </h2>
        <div class="mt-2">
            This action cannot be undone.
        </div>
        <div class="mt-6 flex justify-end">
            <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                x-on:click="$dispatch('close-modal')">
                Cancel
            </button>
            <button class="ms-3 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                x-on:click="$dispatch('confirm-action'); $dispatch('close-modal')"
                x-text="modalAction === 'deactivate' ? 'Confirm Deactivate' : 'Confirm Delete'">
            </button>
        </div>
    </div>
</div>

<!-- Global Modal Store -->
@once
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('modal', {
                currentModal: null,
                action: null,
                // Removed tempAction as it's no longer needed
            });
        });
    </script>
@endonce
