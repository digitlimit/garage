import axios  from 'axios';
import helper from './Helper';

axios.defaults.baseURL = helper.apiBaseUrl();

axios.interceptors.response.use( function (response) {
  // triggered by status code 2xx
  return response;
},

function (error)
{ console.log(error);
  const { response } = error;
  const { data }     = response;

  let errors  = {};
  let message = '';

  switch(response.status) 
  {
    case 422:
      errors  = helper.errors(data.errors);
      message = data.message;
      break;

    case 404:
      message = 'Resource not found'
      break;
  }

  return Promise.reject({
    errors,
    message,
    response
  });
});

export default {

  async get(url, params, success, error) 
  {
    const config = {};
    if (params) config.params = params;

    try {
      const { data } = await axios.get(url, config);
      if (typeof success === 'function') success(data);
      return data;
    } catch (e) {
      if (typeof error === 'function') error(e);
    } finally {
    }
  },

  async post(url, params, success, error) 
  {
    try {
      const { data }  = await axios.post(url, params);
      if (typeof success === 'function') success(data);
      return data;
    } catch (e) {
      if (typeof error === 'function') error(e);
    } finally {
    }
  },

  async patch(url, params, success, error) 
  {
    const config = {};
    if (params) config.params = params;

    try {
      const { data } = await axios.patch(url, config);
      if (typeof success === 'function') success(data);
      return data;
    } catch (e) {
      if (typeof error === 'function') error(e);
    } finally {
    }
  },

  async delete(url, params, success, error) 
  {
    const config = {};
    if (params) config.params = params;

    try {
      const { data } = await axios.delete(url, config);
      if (typeof success === 'function') success(data);
      return data;
    } catch (e) {
      if (typeof error === 'function') error(e);
    } finally {
    }
  }
};

