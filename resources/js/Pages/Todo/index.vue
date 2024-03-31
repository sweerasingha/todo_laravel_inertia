<template>
    <AppLayout>
        <template #content>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h1 class="page-title">My Todo List</h1>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <form @submit.prevent="taskStore">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <input
                                            class="form-control"
                                            name="title"
                                            type="text"
                                            v-model="task_form.title"
                                            placeholder="Add new task"
                                            aria-label="default input example"
                                            required
                                        />
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <button
                                        type="submit"
                                        class="btn btn-success"
                                    >
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-12 mt-4">
                        <div>
                            <table class="table table-success table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        v-for="(task, index) in task_list"
                                        :key="index"
                                    >
                                        <th scope="row">{{ index + 1 }}</th>
                                        <td>{{ task.title }}</td>
                                        <td>
                                            <span
                                                v-if="task.done"
                                                class="badge bg-success"
                                            >
                                                Completed
                                            </span>
                                            <span
                                                v-else
                                                class="badge bg-danger"
                                            >
                                                Incompleted
                                            </span>
                                        </td>
                                        <td>
                                            <button
                                                class="btn btn-primary"
                                                @click.prevent="taskEditModal(task.id)"
                                            >
                                                <i
                                                    class="fa-solid fa-check"
                                                ></i>
                                            </button>

                                            <button
                                                @click.prevent="
                                                    deleteTask(task.id)
                                                "
                                                class="btn btn-danger"
                                            >
                                                <i
                                                    class="fa-solid fa-trash-can"
                                                ></i>
                                            </button>
                                            <button
                                                @click.prevent="
                                                    doneTask(task.id)
                                                "
                                                class="btn btn-success"
                                            >
                                                <i
                                                    class="fa-solid fa-check"
                                                ></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template #modal>
            <div
                class="modal fade"
                id="taskEdit"
                tabindex="-1"
                role="dialog"
                aria-labelledby="taskEditLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="taskEditLabel">
                                Main Task Edit
                            </h5>
                        </div>
                        <div class="modal-body" id="taskEditContent">
                            <form @submit.prevent="taskUpdate">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <input
                                                class="form-control"
                                                name="title"
                                                type="text"
                                                v-model="task_update_form.title"
                                                placeholder="Add new task"
                                                aria-label="default input example"
                                                required
                                            />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <button
                                            type="submit"
                                            class="btn btn-success"
                                        >
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { usePage } from "@inertiajs/inertia-vue3";
import { computed } from "@vue/reactivity";
import axios from "axios";

export default {
    components: {
        AppLayout,
    },
    data() {
        return {
            task_form: {
                title: "",
            },
            task_update_form: {
                title: "",
            },
            task_list: [],
        };
    },
    beforeMount() {
        this.getTasks();
    },
    methods: {
        async getTasks() {
            const tasks = (await axios.get(route("todo.list"))).data;
            this.task_list = tasks;
        },
        async taskStore() {
            await axios.post(route("todo.store"), this.task_form);
            this.getTasks();
            this.task_form.title = "";
        },
        async deleteTask(id) {
            await axios.delete(route("todo.delete", id));
            this.getTasks();
        },
        async doneTask(id) {
            await axios.get(route("todo.done", id));
            this.getTasks();
        },
        async taskEditModal(id) {
            const task = (await axios.get(route("todo.get", id))).data;
            this.task_update_form = task;
            $("#taskEdit").modal("show");
        },
        async taskUpdate() {
            await axios.post(
                route("todo.update", this.task_update_form.id),
                this.task_update_form
            );
            this.getTasks();
            $("#taskEdit").modal("hide");
        },
    },
};
</script>

<style lang="scss" scoped>
.page-title {
    padding-top: 5vh;
    font-size: 5rem;
    color: rgb(10, 205, 124);
}
</style>
