<template>
        <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg bg-yellow-200">
            <div class="text-3xl text-gray-900">{{appName}}</div>
            <div class="text-lg text-gray-600">{{appClaim}}</div>
        </div>
</template>

<script>
export default {
    name: 'Header',
    data() {
        return {
            appName: window.appConfig.appName || "",
            appClaim: window.appConfig.appClaim || "",
        };
    }
};
</script>