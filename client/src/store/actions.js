import axios from "axios";
import { baseUrl } from "../assets";

export function setToken(token) {
  commit("setToken", token);
}

export function setUser({ commit }, user) {
  commit("setUser", user);
}

export function getUserById({ commit }, user) {
  return new Promise((resolve, reject) => {
    axios
      .get(`${baseUrl}api/users/${user.id}`, {
        headers: {
          Authorization: `Bearer ${user.token}`,
        },
      })
      .then((response) => {
        commit("setUser", {
          id: response.data.user.id,
          username: response.data.user.username,
          phone: response.data.user.phone,
          active: response.data.user.active,
          token: response.data.token,
        });
        resolve(response);
      })
      .catch((error) => {
        reject(error);
      });
  });
}

export function getOrganizationById({commit}, user) {
  return new Promise((resolve, reject) => {
    axios
      .get(`${baseUrl}api/organizations/${user.id}`, {
        headers: {
          Authorization: `Bearer ${user.token}`,
        },
      })
      .then((response) => {
        commit("setOrganization", {
          id: response.data.organization.id,
          name: response.data.organization.name,
          address: response.data.organization.address,
          phone: response.data.organization.phone,
          email: response.data.organization.email,
          website: response.data.organization.website,
          logo: response.data.organization.logo,
          token: response.data.token,
        });
        resolve(response);
      })
      .catch((error) => {
        reject(error);
      });
  });
}
