<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>

        <!-- Add this line to import the compiled css -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <login-component>
                <template>
                <div class="login">
                    <h2>Login Page</h2>
                    <form @submit.prevent="login">
                    <div>
                        <label>Username:</label>
                        <input type="text" v-model="username" required>
                    </div>
                    <div>
                        <label>Password:</label>
                        <input type="password" v-model="password" required>
                    </div>
                    <button type="submit">Login</button>
                    </form>
                </div>
                </template>

                <script>
                export default {
                data() {
                    return {
                    username: "",
                    password: ""
                    };
                },
                methods: {
                    login() {
                    // Here you would typically send a request to your server to log the user in
                    // For this example, we're just logging the username and password to the console
                    console.log(`Logging in with username ${this.username} and password ${this.password}`);
                    this.username = "";
                    this.password = "";
                    }
                }
                };
                </script>

                <style scoped>
                .login {
                width: 300px;
                margin: auto;
                padding: 10px;
                box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
                }

                input {
                display: block;
                margin-bottom: 10px;
                padding: 5px;
                width: 100%;
                }
                </style>
            </login-component>
        </div>

        <!-- Add these lines to import the compiled js -->
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>