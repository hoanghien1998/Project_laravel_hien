<template>
    <div class="loginVue">
        <h3>Login Form</h3>
        <b-form @submit="onSubmit">
            <b-form-group
                id="input-group-1"
                label="Email address:"
                label-for="input-1"
            >
                <b-form-input
                    id="input-1"
                    v-model="form.email"
                    type="email"
                    required
                    placeholder="Enter email"
                ></b-form-input>
            </b-form-group>

            <b-form-group id="input-group-2" label="Your Password:" label-for="input-2">
                <b-form-input
                    id="input-2"
                    v-model="form.password"
                    required
                    placeholder="Enter password"
                ></b-form-input>
            </b-form-group>

            <b-button type="submit" variant="danger">Login</b-button>
        </b-form>

    </div>
</template>

<script>
export default {
    name: "Login",
    data() {
        return {
            form: {
                email: '',
                password: '',
            },
        }
    },

}
</script>

<style scoped>
.loginVue {
    margin: 0 auto;
    background-color: #FAEBD7;
    width: 500px;
    border-radius: 5%;
}

h3 {
    color: #8B0000;
}

#input-group-1 {
    margin-left: 20px;
    margin-right: 20px;
}

#input-group-2 {
    margin-left: 20px;
    margin-right: 20px;
}

</style>
