<div id="modal-one"
    class="fixed top-0 left-0 hidden w-full h-full overflow-x-hidden overflow-y-auto transition-all duration-500 pointer-events-none hs-overlay z-70">
    <div
        class="flex flex-col my-8 transition-all duration-500 ease-in-out -translate-y-5 bg-white rounded shadow-sm opacity-0 hs-overlay-open:translate-y-0 hs-overlay-open:opacity-100 sm:max-w-lg sm:w-full sm:mx-auto">
        <div class="flex flex-col border rounded-lg shadow-sm pointer-events-auto border-default-200">
            <div class="flex items-center justify-between px-4 py-3 border-b border-default-200">
                <h3 class="text-lg font-medium text-default-900">
                    Modal title
                </h3>
                <button type="button" class="cursor-pointer text-default-600" data-hs-overlay="#modal-one">
                    <i class="text-lg i-tabler-x"></i>
                </button>
            </div>
            <div class="p-4 overflow-y-auto">
                <p class="mt-1 text-default-600">
                    This is a wider card with supporting text below as a natural lead-in to additional content.
                </p>
            </div>
            <div class="flex items-center justify-end px-4 py-3 border-t gap-x-2 border-default-200">
                <button type="button"
                    class="inline-flex items-center justify-center px-5 py-2 text-sm font-medium tracking-wide text-center align-middle duration-500 border rounded-md bg-primary/5 hover:bg-primary border-primary/10 hover:border-primary text-primary hover:text-white"
                    data-hs-overlay="#modal-one">
                    <i class="i-tabler-x me-1"></i>
                    Close
                </button>
                <a class="inline-flex items-center justify-center px-5 py-2 text-sm font-medium tracking-wide text-center text-white align-middle duration-500 border rounded-md bg-primary hover:bg-primary-700 border-primary hover:border-primary-700"
                    href="#">
                    Save changes
                </a>
            </div>
        </div>
    </div>
</div>
