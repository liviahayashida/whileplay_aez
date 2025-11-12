const API_URL = "http://localhost/back-end/public/index.php?path=";

async function apiRequest(endpoint, data, method = "POST") {
  const response = await fetch(API_URL + endpoint, {
    method,
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data),
  });
  return await response.json();
}
