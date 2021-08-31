<template>
    <p>ExampleComponent</p>
    <p>{{ test }}</p>
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
