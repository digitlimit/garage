export default {

    apiBaseUrl() {
        return  document.querySelector('meta[name="api-url"]')
            .getAttribute('content');
    },

    siteBaseUrl() {
        return window.location.origin;
    },

    errors(errors) {
        let newErrors = {};
        for(let input in errors){
            newErrors[input] = errors[input][0];
        }
        return newErrors;
    },

    response(res) {
        let data = null;
        if(res.data && res.data.success){
            data = res.data.data ? res.data.data : res.data;
        }
        return data;
    },

    dateYmd(date) {

        if(typeof date.getMonth === 'function') {
            return date.toISOString().split('T')[0];
        }
        
        return date;
    }
}