<template>
    <div class="bg-gray-100">
    <div class="container mx-auto pt-6 sm:pt-0">

        <Header/>

        <Loading v-if="isLoading"/>

        <div :class="{ 'blur-sm': isLoading}">
            <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

                <table class="w-full ">
                    <tbody>
                        <tr class="bg-slate-50">
                            <td class="py-2 font-bold">ID</td>
                            <td class="py-2 font-bold">IMAGE</td>
                            <td class="py-2 font-bold">NAME</td>
                            <td class="py-2 font-bold">TAG LINE</td>
                            <td class="py-2 font-bold">FIRST BREWED</td>
                        </tr>
                        <tr v-for="item in data" :key="item.id">
                            <td class="py-2">{{ item.id }}</td>
                            <td class="py-2">
                                <div class="w-10 h-10">
                                    <img v-if="item.image_url" class="rounded-full w-full h-full object-cover" :src="item.image_url" alt="{{ item.name }}">
                                </div>
                            </td>
                            <td class="py-2">{{ item.name }}</td>
                            <td class="py-2">{{ item.tagline }}</td>
                            <td class="py-2">{{ item.first_brewed }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div>
            <div class="flex items-center justify-between mt-4">
                <div>
                    <span class="text-sm text-gray-600">Showing {{((page-1)*per_page)+1}} to {{((page)*per_page)}} of {{total_items}} entries</span>
                </div>
                <div>
                    <nav class="inline-flex space-x-2">
                        <button @click="prevPage()" class="px-3 py-1 bg-gray-300 rounded-md">&laquo; Prev</button>
                        <button @click="nextPage()" class="px-3 py-1 bg-gray-300 rounded-md">Next &raquo;</button>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>

    import Header from "./components/Header.vue"
    import Loading from "./components/Loading.vue"

    export default {
        name: "Dashboard",
        components: {
            Header,
            Loading
        },
        data() {
            return {
                data: [],
                isLoading:false,
                page: this.$route.params.page || 1,
                per_page: window.appConfig.itemsPerPage || 15,
                total_items: window.appConfig.itemsTotal,
            }
        },
        mounted() {
            this.$data.isLoading = true;
            this.fetchData({ 
                page: this.page,
                per_page: this.per_page
            });
        },
        watch: {
            '$route.params.page'(page, prevPage) {
                this.$data.isLoading = true;
                this.fetchData({ 
                    page: this.page,
                    per_page: this.per_page
                });
            }
        },
        methods: {

            nextPage() {
                if(this.$data.page < Math.ceil(this.$data.total_items / this.$data.per_page) ) {
                    this.$data.page = parseInt(this.$data.page) + 1
                    this.$router.push(`/dashboard/${this.$data.page}`); 
                }
            },

            prevPage() {
                if(this.$data.page > 1) {
                    this.$data.page = parseInt(this.$data.page) - 1
                    this.$router.push(`/dashboard/${this.$data.page}`)
                }
            },

            async fetchData(params) {
                try {
                    const url = `/api/beers?${new URLSearchParams(params)}`
                    const token = localStorage.getItem('token')
                    if(token) {
                        const response = await fetch(url, {
                            method: 'GET',
                            headers: {
                                'Content-Type': 'application/json',
                                'Authorization': `Bearer ${token}`
                            }
                        });
                        this.$data.isLoading = false;

                        if(response.status == 200) {
                            this.data = await response.json()
                        } else {
                            throw new Error('Unauthorized access: token exipired');
                        }
                    } else {
                        throw new Error('Unauthorized access: token missing');
                    }

                } catch (error) {
                    this.$data.isLoading = false;
                    console.error('Error fetching data:', error);
                    this.$router.push(`/`)
                }
            },
        },
    };
</script>

<style>

@keyframes progressAnimation {
  0% {
    width: 0%;
  }
  100% {
    width: 100%;
  }
}

.animate-progress {
  animation: progressAnimation 1s linear infinite;
}

</style>