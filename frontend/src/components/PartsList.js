import React, { useState, useEffect } from "react";
import api from "../api";

function PartsList() {
  const [parts, setParts] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    api
      .get("/parts")
      .then((response) => {
        console.log("Resposta da API:", response.data); // Verificando a estrutura
        setParts(response.data.data); // Acessando a lista de partes corretamente
        setLoading(false);
      })
      .catch((error) => {
        console.error("Erro ao buscar as partes:", error);
        setLoading(false);
      });
  }, []);

  if (loading) {
    return <div>Carregando...</div>;
  }

  return (
    <div>
      <h1>Lista de Peças</h1>
      {loading ? (
        <div>Carregando...</div>
      ) : (
        <ul>
          {Array.isArray(parts) && parts.length > 0 ? (
            parts.map((part) => (
              <li key={part.id}>
                <h3>{part.name}</h3>
                <p>{part.description}</p>
                <p>{part.price}</p>
                <img src={part.image_path} alt={part.name} />
              </li>
            ))
          ) : (
            <div>Não há peças para exibir.</div>
          )}
        </ul>
      )}
    </div>
  );
}

export default PartsList;
