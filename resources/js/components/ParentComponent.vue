<template>

    <div>

    <div>
<!--     <admin-component v-if="isadmin"></admin-component>
    <pasatiempo-component v-else></pasatiempo-component> -->
    <tarea-component></tarea-component>
    </div>

    </div>

</template>

<script>

 export default {
        data() {
            return {
                isadmin: false,
            }
        },
        mounted() {
            let id = this.obtenerCookie('idusuariologueado');
            console.log(`id de usuario logueado es ${id}`);
            axios.get(`isadmin/${id}`)
                .then((res) => {
                        console.log(res);
                        let is_admin = res.data.data[0].is_admin;
                        this.isadmin = is_admin;

                });
        },
        methods: {
           obtenerCookie(cname) {
                var name = cname + "=",
                ca = document.cookie.split(';'),
                i,
                c,
                ca_length = ca.length;
                for (i = 0; i < ca_length; i += 1) {
                    c = ca[i];
                    while (c.charAt(0) === ' ') {
                        c = c.substring(1);
                    }
                    if (c.indexOf(name) !== -1) {
                        return c.substring(name.length, c.length);
                    }
                }
                return "";
            }
        }
    }

</script>
