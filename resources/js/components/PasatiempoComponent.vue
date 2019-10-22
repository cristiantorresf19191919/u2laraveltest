<template>
    <div>

        <form @submit.prevent="editarNota(pasatiempo)" v-if="isedited">
        <h3>Edita tus Pasatiempos</h3>
        <input type="text" placeholder="nombre" class="form-control mb-2" v-model="pasatiempo.name">
        <input type="text" placeholder="description" class="form-control mb-2" v-model="pasatiempo.description">
        <button class="btn btn-success btn-sm" type="submit">Guardar</button>
        <button class="btn btn-danger btn-sm" type="submit" @click="cancelarEdicion()">Cancelar</button>
        </form>

        <form @submit.prevent="agregar" v-else>
        <h3>Agrega tus Pasatiempos</h3>
        <input type="text" placeholder="nombre" class="form-control mb-2" v-model="pasatiempo.name">
        <input type="text" placeholder="description" class="form-control mb-2" v-model="pasatiempo.description">
        <button class="btn btn-primary" type="submit">Agregar</button>
        </form>

        <hr class="mt-3">
        <h3>Listado de Pasatiempos</h3>
        <ul class="list-group my-2">
            <li class="list-group-item"
             v-for="(item, index) in pasatiempos" :key="index">
                <p>{{item.name}}</p>
                <p>{{item.description}}</p>
                <span class="badge badge-primary float-right">
                    {{item.updated_at}}
                </span>
                <button class="btn btn-danger btn-sm" @click="eliminar(item,index)">eliminar</button>
                <button class="btn btn-warning btn-sm" @click="editar(item)">Editar</button>
            </li>
        </ul>
    </div>

</template>

<script>

export default{
    data(){
        return{
            pasatiempos: [],
            pasatiempo:{name:'',description:'',id:''},
            isedited:false
        }
    },
    created(){
        axios.get('/pasatiempos')
            .then(res =>{
                this.pasatiempos = res.data;
            })

    },
    methods:{
        agregar(){
            if (this.pasatiempo.name.trim() === '' || this.pasatiempo.description.trim() === ''){
                alert('campos incompletos');
                return;
            }
            const objenviar = {name: this.pasatiempo.name, description: this.pasatiempo.description};

            this.pasatiempo.name = '';
            this.pasatiempo.description = '';
            axios.post('/pasatiempos',objenviar).then((res)=>{
                console.log(res);

                this.pasatiempos.push(res.data);
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
            this.pasatiempo.name= item.name;
            this.pasatiempo.description = item.description;
            this.pasatiempo.id = item.id;
        },
        cancelarEdicion(){
            this.isedited = false;
            this.pasatiempo.name = '';
            this.pasatiempo.description = '';
        },
        editarNota(item){

            const params = {name: item.name, description: item.description};
            axios.put(`/pasatiempos/${item.id}`,params)
                .then(res=>{
                    const index = this.pasatiempos.findIndex(pasatiempo => pasatiempo.id === res.data.id);
                    this.pasatiempos[index] = res.data;

                    this.cancelarEdicion();
                     axios.get('/pasatiempos')
                        .then(res =>{
                        this.pasatiempos = res.data;
                        })
                });
        }
    }


}
</script>
