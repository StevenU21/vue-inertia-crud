<template>
    <div class="file-upload-container">
        <div class="file-upload">
            <input
                type="file"
                multiple
                @change="handleFileChange"
                ref="fileInput"
                accept="image/*"
                id="file-input"
                class="hidden"
            />
            <label for="file-input" class="upload-label">
                <i class="fas fa-cloud-upload-alt"></i> Seleccionar archivos
            </label>
            <button @click="uploadFiles" :disabled="files.length === 0">
                <i class="fas fa-upload"></i> Subir
            </button>
        </div>
        <div class="preview-container" v-if="files.length > 0">
            <h3>Vista previa de archivos:</h3>
            <div class="preview-grid">
                <div
                    v-for="(file, index) in files"
                    :key="index"
                    class="preview-item"
                >
                    <img
                        :src="file.preview"
                        :alt="file.name"
                        class="preview-image"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {
    props: {
        csrfToken: String,
    },
    data() {
        return {
            files: [],
        };
    },
    methods: {
        handleFileChange(event) {
            const selectedFiles = Array.from(event.target.files).slice(0, 10);
            this.files = selectedFiles.map((file) => {
                return {
                    file,
                    name: file.name,
                    preview: URL.createObjectURL(file),
                };
            });
        },
        async uploadFiles() {
            const formData = new FormData();
            this.files.forEach(({ file }) => {
                formData.append("file[]", file);
            });

            try {
                const response = await axios.post("/images", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data",
                        "X-CSRF-TOKEN": this.csrfToken,
                    },
                });
                if (Array.isArray(response.data)) {
                    this.$emit("files-uploaded", response.data);
                    Swal.fire({
                        icon: "success",
                        title: "¡Éxito!",
                        text: "Los archivos se han subido correctamente.",
                    });
                    this.files = []; // Clear the files array
                    this.$refs.fileInput.value = ""; // Clear the file input
                } else {
                    console.error("Unexpected response format:", response.data);
                }
            } catch (error) {
                if (error.response) {
                    console.error("Error response:", error.response.data);
                } else if (error.request) {
                    console.error("Error request:", error.request);
                } else {
                    console.error("Error message:", error.message);
                }
            }
        },
    },
};
</script>

<style scoped>
@import '@fortawesome/fontawesome-free/css/all.css';

.file-upload-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
    border: 2px solid #4a5568; /* Dark gray border */
    border-radius: 8px;
    background-color: #2d3748; /* Dark background */
    color: #e2e8f0; /* Light text color */
    animation: fadeIn 1s ease-in-out;
}

.file-upload {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

.upload-label {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    background-color: #4a5568; /* Dark gray button */
    color: #e2e8f0; /* Light text color */
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.upload-label:hover {
    background-color: #2d3748; /* Darker background on hover */
}

.file-upload button {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    background-color: #4a5568; /* Dark gray button */
    color: #e2e8f0; /* Light text color */
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.file-upload button:disabled {
    background-color: #718096; /* Disabled button color */
    cursor: not-allowed;
}

.file-upload button:hover:enabled {
    background-color: #2d3748; /* Darker background on hover */
}

.preview-container {
    margin-top: 20px;
    width: 100%;
}

.preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 10px;
}

.preview-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    animation: fadeIn 0.5s ease-in-out;
}

.preview-image {
    max-width: 100px;
    max-height: 100px;
    object-fit: cover;
    border-radius: 4px;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>
