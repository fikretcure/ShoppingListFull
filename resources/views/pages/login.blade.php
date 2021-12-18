<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .container-fluid {
            background-color: #eee;
            height: 100vh;
        }

        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #fccb90;
            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }

        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
            }
        }
    </style>
    @include('layout.CdnHeader')
</head>

<body>
    <div id="app">
        <div class="container-fluid ">
            <section class="h-100 gradient-form" style="background-color: #eee;">
                <div class="container py-5 h-100">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-xl-10">
                            <div class="card rounded-3 text-black">
                                <div class="row g-0">
                                    <div class="col-lg-6">
                                        <div class="card-body p-md-5 mx-md-4">
                                            <div class="text-center">
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.png" style="width: 185px;" alt="logo">
                                                <h4 class="mt-1 mb-5 pb-1">Alışveriş Sepeti Uygulaması (todo list)</h4>
                                            </div>
                                            <form>
                                                <p>Please login to your account</p>
                                                <div class="form-outline mb-4">
                                                    <input v-model="email" type="email" id="form2Example11" class="form-control" placeholder="Email address" required />
                                                    <label class="form-label" for="form2Example11">Email</label>
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <input v-model="password" type="password" id="form2Example22" class="form-control" required />
                                                    <label class="form-label" for="form2Example22">Password</label>
                                                </div>
                                                <div v-if="error" class="text-center">
                                                    @{{error_text}}
                                                </div>
                                                <div class="text-center pt-1 mb-5 pb-1">
                                                    <button @click="login()" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="button">Log in</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                        <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                            <h4 class="mb-4">We are more than just a company</h4>
                                            <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.26/vue.global.prod.min.js" integrity="sha512-yY2w8QVShzoLAachKPHtZRjXZeQOi9rQ2dYEYLf+lelt+TvZVOm/AlqVX6xFrjiy6wKDxgqvT1RL3BjxPdq/UA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const app = {
            data() {
                return {
                    email: null,
                    password: null,
                    error: true,
                    error_text: null
                }
            },
            methods: {
                login() {
                    axios.post('/api/v1/auth/login', {
                            email: this.email,
                            password: this.password
                        })
                        .then(function(response) {
                            // console.log(response);
                        })
                        .catch(function(errors) {
                            // if (errors.response.status == 400) {} else {
                            // }
                            this.error_text = 43243;
                        });
                }
            },
            computed: {
                test() {}
            }
        }
        Vue.createApp(app).mount('#app');
    </script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.10.1/mdb.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>

</html>