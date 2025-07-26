// resources/js/app.js

// Importa funções essenciais do Vue para criar a aplicação.
import { createApp, h } from 'vue';
// Importa a função createInertiaApp para inicializar o Inertia.js.
import { createInertiaApp } from '@inertiajs/vue3';

// **NOVO:** Importa o helper 'resolvePageComponent' do 'laravel-vite-plugin/inertia-helpers'.
// ESTE É CRUCIAL para o Vite saber quais componentes de página Vue ele precisa
// incluir no manifest.json de forma que o Laravel possa encontrá-los.
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

// Importa o arquivo de bootstrap.js (geralmente contém configurações globais, Axios, etc.).
// É uma prática comum para inicializar utilitários globais do Laravel.
import './bootstrap';

// Configuração do Laravel Echo para WebSockets (Pusher/Reverb).
// Esta parte parece estar correta e não precisa de alterações para o problema do Vite.
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.Pusher = Pusher;
window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});

// Importa seus arquivos CSS principais.
// O Vite vai processar estes CSS e incluí-los no build final.
import "../css/reset.css";
import "../css/admin.css";

// Inicializa a aplicação Inertia.js.
createInertiaApp({
    // **MODIFICADO:** A função 'resolve' agora usa 'resolvePageComponent'.
    // 'name' é o nome do componente de página que o Laravel está tentando renderizar (ex: 'inicio').
    // 'resolvePageComponent' é o helper que:
    // 1. Constrói o caminho para o componente específico (ex: './Pages/inicio.vue').
    // 2. Usa `import.meta.glob('./Pages/**/*.vue')` internamente para instruir o Vite a:
    //    a. Escanear a pasta 'resources/js/Pages/' e incluir TODOS os arquivos '.vue'
    //       encontrados lá no seu manifest.json de build (para o cliente).
    //    b. Fazer o mesmo para o build SSR (se configurado no vite.config.js).
    // Isso garante que o Laravel, ao consultar o manifest, encontre a referência correta
    // para o seu componente 'inicio.vue'.
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),

    // Configura o aplicativo Vue.
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin) // Usa o plugin do Inertia.js
            // **NOVO:** Adiciona o Ziggy para que as rotas do Laravel fiquem disponíveis no frontend.
            // O 'Ziggy' global é injetado pela diretiva Blade `@routes`.
            .use(Ziggy)
            .mount(el); // Monta a aplicação no elemento HTML com id 'app'
    },
    // **OPCIONAL:** Adiciona a barra de progresso do Inertia.js (boa prática para UX).
    progress: {
        color: '#4B5563',
    },
});
