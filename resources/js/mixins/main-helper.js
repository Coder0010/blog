import Vue from "vue";
import VueGlobalVar from "vue-global-var";

Vue.use(VueGlobalVar, {
    globals: {
        $fadeTimeOut: "2500",
    }
});

// Export Helper Methods
export default {
    methods: {
        __(_key, _replace) {
            let translation,
                translationNotFound = true;
            try {
                translation = _key
                    .split(".")
                    .reduce((t, i) => t[i] || null, window.W_Translations[window.W_Locale].php);

                if (translation) {
                    translationNotFound = false;
                }
            } catch (e) {
                translation = _key;
            }

            if (translationNotFound) {
                translation = window.W_Translations[window.W_Locale]["json"][_key]
                    ? window.W_Translations[window.W_Locale]["json"][_key]
                    : _key;
            }

            _.forEach(_replace, (_value, _key) => {
                translation = translation.replace(":" + _key, _value);
            });

            return translation;
        },
    }
};
