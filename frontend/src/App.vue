<script setup lang="ts">
</script>

<template>

    <header>

        <h1>
            Nemon Energy Calculator
        </h1>

        <nav>

            <RouterLink to="/consumptions">
                Consumptions
            </RouterLink>

            <RouterLink to="/prices">
                Prices
            </RouterLink>

            <RouterLink to="/indexed-price">
                Indexed Price
            </RouterLink>

        </nav>

    </header>

    <main>

        <RouterView />

    </main>

</template>

<style scoped>

header {

    padding: 20px;

    border-bottom: 1px solid #DDD;
}

nav {

    display: flex;

    gap: 20px;

    margin-top: 15px;
}

nav a {

    text-decoration: none;

    color: #1976d2;

    font-weight: bold;
}

nav a.router-link-active {

    color: #000;
}

main {

    padding: 20px;
}

</style>