export default {
    proxy: 'https://beautyevents.test',
    files: [
        './**/*.php',
        './assets/dist/assets/*.css',
        './assets/dist/assets/*.js',
    ],
    https: true,
    open: false,
    notify: false,
    port: 3000,
    ui: false,
};
