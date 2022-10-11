<template>
    <div class="flex items-center justify-center w-screen h-screen bg-gray-800">
        <form method="GET">
            <div class="relative text-gray-600 focus-within:text-gray-400">
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <button type="submit" class="p-1 focus:outline-none focus:shadow-outline">
                        
                    </button>
                </span>
                <input type="search" name="q"
                    class="py-2 text-sm text-white bg-gray-900 rounded-md pl-10 focus:outline-none focus:bg-white focus:text-gray-900"
                    placeholder="Search..." autocomplete="off">
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        logout_url: String,
        csrf: String
    }
}
</script>
