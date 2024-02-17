<template>
    <div class="bg-gray-100">
    <div class="container mx-auto pt-6 sm:pt-0">

        <div class="w-full mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg bg-yellow-200">
            <div class="text-3xl text-gray-900">BRE<span class="text-red-600">W</span>herehouse</div>
            <div class="text-lg text-gray-600">Uncover your next sip</div>
        </div>

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
                                <img class="rounded-full w-full h-full object-cover" :src="item.image_url" alt="{{ item.name }}">
                            </div>
                        </td>
                        <td class="py-2">{{ item.name }}</td>
                        <td class="py-2">{{ item.tagline }}</td>
                        <td class="py-2">{{ item.first_brewed }}</td>
                    </tr>
                </tbody>
            </table>

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
    export default {
        data() {
            return {
                data: [],
                page: 1,
                per_page: 10,
                total_items: 325,
            }
        },
        mounted() {
            const page = this.$route.params.page
            this.page = page
            const per_page = this.per_page
            this.fetchData({ 
                page,
                per_page
            });
        },
        watch: {
            '$route.params.page'(page, prevPage) {
                this.page = page

                this.fetchData({ 
                    page,
                    per_page: this.per_page
                });
            }
        },
        methods: {

            nextPage() {
                if(this.$data.page < Math.ceil(this.$data.total_items / this.$data.per_page) ) {
                    this.$data.page = this.$data.page*1 + 1
                    this.$router.push(`/dashboard/${this.$data.page}`); 
                }
            },

            prevPage() {
                if(this.$data.page > 1) {
                    this.$data.page = this.$data.page*1 - 1
                    this.$router.push(`/dashboard/${this.$data.page}`); 
                }
            },

            async fetchData(params) {
                try {
                    const url = `/api/beers?${new URLSearchParams(params)}`
                    const bearerToken = localStorage.getItem('token')
                    const response = await fetch(url, {
                        method: 'GET',
                        headers: {
                            'Content-Type': 'application/json',
                            'Authorization': `Bearer ${bearerToken}`
                        }
                    });

                    const result = await response.json();

                    console.log(result)

                    this.data = result;
                } catch (error) {
                    console.error('Error fetching data:', error);
                }
            },
        },
    };
</script>