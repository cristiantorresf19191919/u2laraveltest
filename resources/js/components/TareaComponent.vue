<template>
    <div>

        <form @submit.prevent="editarNota(pasatiempo)" v-if="isedited">
        <h3>Edita tus Tareas</h3>
        <input type="text" placeholder="nombre" class="form-control mb-2" v-model="tarea.name">
        <input type="text" placeholder="description" class="form-control mb-2" v-model="tarea.description">
        <button class="btn btn-success btn-sm" type="submit">Guardar</button>
        <button class="btn btn-danger btn-sm" type="submit" @click="cancelarEdicion()">Cancelar</button>
        <p class="badge badge-danger" v-if="contenidoerror"> <b>{{contenidoerror}}}</b></p>
        <p class="badge badge-danger" v-if="contenidoerror2"> <b>{{contenidoerror2}}}</b></p>
        </form>

        <form @submit.prevent="agregar" v-else>
        <h3>Agrega tus Tareas</h3>
        <input type="text" placeholder="nombre" class="form-control mb-2" v-model="tarea.name">
        <input type="text" placeholder="description" class="form-control mb-2" v-model="tarea.description">
        <button class="btn btn-primary" type="submit">Agregar</button>
        </form>

        <hr class="mt-3">
        <h3>Listado de Tareas</h3>
        <ul class="list-group my-2">
            <li class="list-group-item"
             v-for="(item, index) in tareas" :key="index">
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
            tareas: [],
            tarea:{name:'',description:'',id:''},
            isedited:false,
            contenidoerror:'',
            contenidoerror2:''
        }
    },
    created(){
        axios.get('/tareas')
            .then(res =>{
                this.tareas = res.data;
            })

    },
    methods:{
        agregar(){
            if (this.tarea.name.trim() === '' || this.tarea.description.trim() === ''){
                alert('campos incompletos');
                return;
            }
            const objenviar = {name: this.tarea.name, description: this.tarea.description};

            this.tarea.name = '';
            this.tarea.description = '';
            axios.post('/tareas',objenviar).then((res)=>{
                console.log(res);
                if (res.data.created_at){
                     this.tareas.push(res.data);
                } else {
                    console.log(res.data.error);
                    if (res.data.error.name) {
                        for(let i of res.data.error.name){
                        this.contenidoerror = i;
                        alert(i);
                    }

                    }
                    if (res.data.error.description) {
                        for(let i of res.data.error.description){
                        this.contenidoerror2 = i;
                        alert(i);
                    }

                    }



                }

            });
        },
        eliminar(item, index){
            axios.delete(`/tareas/${item.id}`)
                .then(()=>{
                    this.tareas.splice(index,1);
                });
        },
        editar(item){
            this.isedited = true;
            this.tarea.name= item.name;
            this.tarea.description = item.description;
            this.tarea.id = item.id;
        },
        cancelarEdicion(){
            this.isedited = false;
            this.tarea.name = '';
            this.tarea.description = '';
        },
        editarNota(item){

            const params = {name: item.name, description: item.description};
            axios.put(`/tareas/${item.id}`,params)
                .then(res=>{
                    const index = this.tareas.findIndex(tarea => tarea.id === res.data.id);
                    this.tareas[index] = res.data;

                    this.cancelarEdicion();
                     axios.get('/tareas')
                        .then(res =>{
                        this.tareas = res.data;
                        })
                });
        }
    }


}
</script>
