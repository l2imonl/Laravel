<template>
    <div class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="http://jettest.test/">
                    <svg class="w-16 h-16" viewbox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z"
                            fill="#6875F5"/>
                        <path
                            d="M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z"
                            fill="#6875F5"/>
                    </svg>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <form @submit.prevent="login">
                    <div>
                        <h1>{{jwt}}</h1>
                        <label class="block font-medium text-sm text-gray-700">
                            Email
                        </label>

                        <input class="form-input rounded-md shadow-sm block mt-1 w-full" v-model="credentials.mail" type="email" name="email"
                               required="required" autofocus="autofocus">

                    </div>

                    <div class="mt-4">
                        <label class="block font-medium text-sm text-gray-700">
                            Password
                        </label>

                        <input class="form-input rounded-md shadow-sm block mt-1 w-full" v-model="credentials.password" type="password" name="password"
                               required="required" autocomplete="current-password">

                    </div>

                    <div class="block mt-4">
                        <label class="flex items-center">
                            <input type="checkbox" class="form-checkbox" name="remember">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900"
                           href="http://jettest.test/forgot-password">
                            Forgot your password?
                        </a>

                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                            Login
                        </button>

                    </div>
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                            <a href="http://jettest.test/register">
                                Register
                            </a>
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    name: "login",
    data: function () {
        return {
            credentials: {}
        }
    },
    computed:{
        ...mapGetters({jwt: "getToken"}),
    },
    mounted() {

    },
    methods: {
        ...mapActions(["setJwt"]),
        login: function () {
            this.setJwt(this.credentials)
            this.jwt = this.getToken()
        }
    }
}
</script>

<style scoped>

</style>
