<template>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th><a href="#" class="create-client" @click.prevent="showModal">Create</a></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="client in clients">
                    <td v-text="client.title" class="title"></td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>

        <div id="modal-create-client" uk-modal>
            <div class="uk-modal-dialog uk-modal-body">
                <h2 class="uk-modal-title">Create Client</h2>
                <button class="uk-modal-close" type="button"></button>

                <form @submit.prevent="processForm($event)">
                    <input type="text" name="title">
                    <input type="email" name="email">
                    <input type="text" name="address_1">
                    <input type="text" name="address_2">
                    <input type="text" name="city">
                    <input type="text" name="state">
                    <input type="text" name="zip">
                    <input type="text" name="phone">
                    <input type="submit" value="Save">
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                clients: null
            }
        },

        created: function() {
            axios.get('/api/clients')
                .then(response => {
                    this.clients = response.data;
                })
        },

        methods: {
            showModal: function() {
                UIkit.modal('#modal-create-client').toggle();
            },
            processForm: function(event) {
                let form = $(event.target);

                axios.post('/api/clients', form.serialize())
                    .then(response => {
                        this.clients.push(response.data);
                    })
            }
        }
    }
</script>
