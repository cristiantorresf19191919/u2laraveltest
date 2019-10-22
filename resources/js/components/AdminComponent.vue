<template>
    <div>
        <h1 class="text-center my-4">ADMINISTRADOR</h1>
        <form @submit.prevent="editarUsuarioPasatiempo(formdata)" v-if="isedited" id="editarusuarios">
        <h3>Editar usuarios</h3>
        <input type="text" placeholder="nombre" class="form-control mb-2" v-model="formdata.name">
        <input type="text" placeholder="nombre de usuario" class="form-control mb-2" v-model="formdata.username">
        <input type="text" placeholder="ciudad" class="form-control mb-2" v-model="formdata.city">
        <input type="text" placeholder="pasatiempo" class="form-control mb-2" v-model="formdata.name">
        <div v-if="formdata.pasatiempos.length > 0">
            <span class="badge badge-warning d-block">EDITAR Pasatiempos</span>
                 <li class="list-group-item text-center border border-primary"
                     v-for="(pasatiempo, indexp) in formdata.pasatiempos" :key="indexp">
                     <hr class="my-3">
                     <b>pasatiempo No {{indexp}}</b>
                     <span class="badge badge-success d-block">nombre de pasatiempo</span><input type="text" placeholder="nombre de pasatiempo" class="form-control mb-2" v-model="pasatiempo.name">
                     <span class="badge badge-success d-block">descripcion de pasatiempo</span> <input type="text" placeholder="descripcion de pasatiempo" class="form-control mb-2" v-model="pasatiempo.description">

                 </li>
        </div>
        <div v-else><p class="badge badge-secondary">No hay pasatiempos</p></div>
        <button class="btn btn-success btn-sm" type="submit">Guardar</button>
        <button class="btn btn-danger btn-sm" type="submit" @click="cancelarEdicion()">Cancelar</button>
        </form>

        <form @submit.prevent="agregar" v-else>
        <h3>Agregar usuarios</h3>
        <input type="text" placeholder="nombre" class="form-control mb-2" v-model="usuario.name">
        <input type="text" placeholder="nombre de usuario" class="form-control mb-2" v-model="usuario.username">
        <input type="text" placeholder="ciudad" class="form-control mb-2" v-model="usuario.city">
        <input type="text" placeholder="pasatiempo" class="form-control mb-2" v-model="pasatiempo.name">
        <input type="text" placeholder="descripcion" class="form-control mb-2" v-model="pasatiempo.description">
        <button class="btn btn-primary" type="submit">Agregar</button>
        </form>

        <hr class="mt-3">
        <h3>Listado de Usuarios</h3>
        <ul class="list-group my-2">
            <li class="list-group-item text-center"
             v-for="(item, index) in usuarios" :key="index">
             <span class="badge badge-info d-block">nombre </span><p>{{item.name}}</p>
             <span class="badge badge-info d-block">nombre de usuario </span><p>{{item.username}}</p>
             <span class="badge badge-info d-block">ciudad</span> <p>{{item.city}}</p>
             <span class="badge badge-info d-block">id</span> <p>{{item.id}}</p>
             <div v-if="item.pasatiempos.length > 0">
                 <span class="badge badge-warning d-block">Pasatiempos</span>
                 <li class="list-group-item text-center"
                     v-for="(pasatiempo, indexp) in item.pasatiempos" :key="indexp">
                     <b>pasatiempo No {{indexp}}</b>
                     <span class="badge badge-success d-block">pasatiempo id</span> <p>{{pasatiempo.id}}</p>
                     <span class="badge badge-success d-block">nombre de pasatiempo</span><p>{{pasatiempo.name}}</p>
                     <span class="badge badge-success d-block">descripcion de pasatiempo</span> <p>{{pasatiempo.description}}</p>
                     <span class="badge badge-success d-block">pasatiempo user_id</span> <p>{{pasatiempo.user_id}}</p>
                 </li>

             </div>
             <div v-else><p class="badge badge-secondary">No hay pasatiempos</p></div>
                <span class="badge badge-primary float-right">
                    {{item.updated_at}}
                </span>
                <button class="btn btn-danger btn-sm" @click="eliminar(item,index)">eliminar</button>
                <button class="btn btn-warning btn-sm" @click="editar(item)" href="#editarusuarios">Editar</button>
            </li>
        </ul>
    </div>

</template>

<script>

export default{
    data(){
        return{
            usuarios: [],
            usuario:{name:'',city:'',username:''},
            pasatiempo:{name:'',description:'',id:''},
            pasatiempos:[],
            formdata:[],
            isedited:false
        }
    },
    created(){
        axios.get('/admin')
            .then(res =>{
                console.log(res);
                this.usuarios = res.data;
                for (let i of res.data){
                    this.pasatiempos.push(i.pasatiempos);
                }
                console.log(this.pasatiempos);
            })

    },
    methods:{
        agregar(){
            if (this.usuario.name.trim() === '' || this.usuario.city.trim() === ''){
                alert('campos incompletos');
                return;
            }
            const objenviar = {
                name: this.usuario.name,
                city: this.usuario.city,
                username: this.usuario.username,
                pasatiempos:{name:pasatiempo.name, description:pasatiempo.description}};

            this.pasatiempo.name = '';
            this.pasatiempo.description = '';
            axios.post('/admin',objenviar).then((res)=>{
                console.log(res);
                try {
                    this.usuario.push(res.data);

                } catch (error) {
                    console.error(error);
                }
            });
        },
        eliminar(item, index){
            axios.delete(`/pasatiempos/${item.id}`)
                .then(()=>{
                    this.pasatiempos.splice(index,1);
                });
        },
        editar(item){
            this.isedited = true;
            this.formdata = item;
        },
        cancelarEdicion(){
            this.isedited = false;
            this.formdata = [];
        },
        editarUsuarioPasatiempo(item){

            const params = item;
            console.log('datos para actualizar en la base de datos');
            console.log('datos para actualizar en la base de datos');
            console.log(item);
            console.log('datos para actualizar en la base de datos');
            console.log('datos para actualizar en la base de datos');
            console.log('datos para actualizar en la base de datos');
            axios.put(`/admin/${item.id}`,params)
                .then(res=>{
                    const index = this.usuarios.findIndex(usuario => usuario.id === item.id);
                    this.usuarios[index] = item;
                    this.cancelarEdicion();
                      axios.get('/admin')
                            .then(res =>{
                                console.log(res);
                                this.usuarios = res.data;
                            })
                            console.log(res);
                });
        }
    }


}
</script>
