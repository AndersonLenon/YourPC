import axios from "axios";

// Cria uma instância do axios com a URL base configurada
const api = axios.create({
  baseURL: process.env.REACT_APP_API_URL, // Pegando a URL da API do .env
});

export default api;
