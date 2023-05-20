<template>
    <div class="container">
        <div class="row" style="height: 80px"></div>
        <h1>Doctors</h1>
        <div class="row">
            <div>
                <ul v-if="databaseErrors" class="alert alert-danger">
                    <li v-if="databaseErrors">{{ databaseErrors.name }}</li>
                    <li v-if="databaseErrors">{{ databaseErrors.email }}</li>
                    <li v-if="databaseErrors">{{ databaseErrors.password }}</li>
                    <li v-if="databaseErrors">
                        {{ databaseErrors.department_id }}
                    </li>
                </ul>
            </div>
        </div>

        <h1>add titles</h1>
        <div class="row">
            <div class="col-12">
                <form @submit.prevent="store()" class="custom-form">
                    <div class="form-group">
                        <label for="title">title:</label>
                        <input
                            type="text"
                            class="form-control"
                            id="title"
                            v-model.trim="title"
                        />
                        <div v-if="titleVal" class="alert alert-danger">
                            title is required must be text
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="desc">description:</label>
                        <input
                            type="text"
                            class="form-control"
                            id="desc"
                            v-model.trim="desc"
                        />
                        <div v-if="descVal" class="alert alert-danger">
                            desc is required must be text
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="file">file:</label>
                        <input
                            class="form-control"
                            id="file"
                            type="file"
                            ref="fileInput"
                            @change="handleFileUpload"
                        />
                        <img
                            style="width: 100px; height: 100px"
                            :src="results.file"
                            alt=""
                        />

                        <div v-if="fileVal" class="alert alert-danger">
                            file is required must be file ['jpg', 'jpeg', 'png',
                            'gif', 'mp4', 'avi', 'mov']
                        </div>
                    </div>
                    <div class="form-group" style="text-align: center">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row" style="height: 80px"></div>
    </div>
</template>
<script>
export default {
    components: {},

    data() {
        return {
            databaseErrors: null,
            title: "",
            desc: "",
            file: "",

            titleVal: false,
            descVal: false,
            fileVal: false,
            validExtensions: ["jpg", "jpeg", "png", "gif", "mp4", "avi", "mov"],

            results: [],
        };
    },
    methods: {
        store() {
            const formData = new FormData();
            if (this.$refs.fileInput.files[0]) {
                const fileExtension = this.file.name.split(".").pop().toLowerCase();
                this.titleVal =
                    typeof this.title !== "string" || this.title === "";
                this.descVal =
                    typeof this.desc !== "string" || this.desc === "";
                this.fileVal = !this.validExtensions.includes(fileExtension);

                if (this.titleVal || this.descVal || this.fileVal) {
                    return;
                }
                    formData.append("title", this.title);
                    formData.append("desc", this.desc);
                    formData.append("file", this.file);

                this.doneStore(formData);
            } else {
                this.titleVal =
                    typeof this.title !== "string" || this.title === "";
                this.descVal =
                    typeof this.desc !== "string" || this.desc === "";

                if (this.titleVal || this.descVal) {
                    return;
                }

                formData.append("title", this.title);
                formData.append("desc", this.desc);

                this.doneStore(formData);
            }
        },
        doneStore(formData) {
            axios.post(
                    `http://127.0.0.1:8000/api/updateBlog/${this.$route.params.id}`,
                    formData
                )
                .then((res) => {
                    console.log(res.data.data);
                    if (res.status === 200) {
                        this.results = res.data.data;
                        Notification.success("update Blog Success");
                    }
                })
                .catch((error) => {
                    this.databaseErrors = error.response.data.data;
                    console.log(error.response.data.data);
                    console.log(error);
                });
        },
        handleFileUpload() {
            this.file = this.$refs.fileInput.files[0];
            console.log(this.file);
        },
    },
    created() {
        const id = this.$route.params.id;
        axios
            .get(`http://127.0.0.1:8000/api/showBlogId/${id}`)
            .then((res) => {
                console.log(res.data.data.file);
                this.results = res.data.data;
                this.title = res.data.data.title;
                this.desc = res.data.data.desc;
                this.file = res.data.data.file;
            })
            .catch((error) => {
                console.log(error);
            });
    },
};
</script>

<style scoped>
/* Custom CSS for the form */
.custom-form {
    border: 2px solid #223a66;
    border-radius: 10px;
    padding: 20px;
    background-color: #f8f9fa;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
</style>
