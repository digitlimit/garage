export default {

    apiBaseUrl() {
        return  document.querySelector('meta[name="api-url"]')
            .getAttribute('content');
    },

    isUrl(string) {
        let url;
        try {
        url = new URL(string);
        } catch (_) {
        return false;
        }
        return url.protocol === 'http:' || url.protocol === 'https:';
    },

    sortArray(data, orderBy, orderDirection) {
        return data.sort((first, second) => {
        let selector = 1;
        if (orderDirection === 'desc') selector = -1;
        if (first[orderBy] < second[orderBy]) return -1 * selector;
        if (first[orderBy] > second[orderBy]) return 1 * selector;
        return 0;
        });
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
    }
}