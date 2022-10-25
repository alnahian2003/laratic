<div class="flex mx-auto items-center justify-center mt-5  mb-4 max-w-full">
    <form class="w-full max-w-xl bg-gray-800 rounded-lg px-4 pt-2" method="POST" action="{{ route('comments.store') }}">
        <div class="flex flex-wrap -mx-3 mb-6">
            <label for="commentbox" class="hover:cursor-pointer">
                <h2 class="px-4 pt-3 pb-2 text-gray-300 text-lg">Add a new comment</h2>
            </label>
            <div class="w-full md:w-full px-3 mb-2 mt-2">
                <textarea
                    class="bg-gray-600 rounded border border-gray-700 leading-normal resize-none w-full h-20 py-2 px-3 font-medium placeholder-gray-base focus:outline-none focus:bg-gray-900"
                    name="body" placeholder='Share your opinion...' id="commentbox" required></textarea>
            </div>
            <div class="w-full md:w-full flex items-start px-3">
                <div class="-mr-1">
                    <input type='submit'
                        class="bg-gray-700 text-gray-100 font-medium py-2 px-4 rounded-lg tracking-wide mr-1 hover:bg-gray-900 hover:border-transparent cursor-pointer"
                        value='Post Comment'>
                </div>
            </div>
    </form>
</div>
</div>
