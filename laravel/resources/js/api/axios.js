import baseAxios from "axios";

const axios = baseAxios.create({
  baseURL: process.env.MIX_AXIOS_BASEURL,
});

export default axios;
