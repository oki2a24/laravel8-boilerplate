<template>
    <p>ExampleComponent</p>
    <p>{{ test }}</p>
    <router-view />
</template>

<script>
import { ref } from "vue";
export default {
    setup() {
        const test = ref("ref test")
        return {test}
    },
}
</script>
