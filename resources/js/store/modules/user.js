import {
  login,
  signUp,
  getInfo,
<<<<<<< 7895c6227a798fd2b98e1c36a8fa9e4d236c16f4
  getGroups,
  signOut,
  announcements,
  changeEmail,
=======
  signOut,
  announcements,
  forgotPassword,
  conformTokenForgotPwd,
  completeNewPassword,
  getGroups,
>>>>>>> forgot password
} from '@/api/user';
import { getToken, setToken, removeToken } from '@/utils/auth';

const state = {
  accessToken: getToken(),
  tokenType: '',
  expiresAt: '',
  user: {},
  groups: [],
  announcements: [],
};

const mutations = {
  SET_TOKEN: (_state, token) => {
    _state.accessToken = token.accessToken;
    _state.expiresAt = token.expiresAt;
  },
  SET_INFO: (_state, info) => {
    _state.user = info;
  },
  SET_ANNOUNCEMENTS: (_state, data) => {
    _state.announcements = data;
  },
  SET_GROUPS: (_state, groups) => {
    _state.groups = groups;
  },
};

const actions = {
  async login({ commit }, payload) {
    const { email, password } = payload;
    try {
      const { accessToken, expiresAt, user } = await login({ email: email.trim(), password });
      commit('SET_TOKEN', { accessToken, expiresAt });
      commit('SET_INFO', user);
      setToken(accessToken);
      return Promise.resolve();
    } catch (error) {
      return Promise.reject(error);
    }
  },
  async signUp({ commit }, payload) {
    try {
      const { accessToken, expiresAt, user } = await signUp({ ...payload });
      commit('SET_TOKEN', { accessToken, expiresAt });
      commit('SET_INFO', user);
      setToken(accessToken);
      return Promise.resolve();
    } catch (error) {
      return Promise.reject(error);
    }
  },
  async getInfo({ commit }) {
    try {
      const data = await getInfo();
      commit('SET_INFO', data);
      return Promise.resolve(data);
    } catch (error) {
      return Promise.reject(error);
    }
  },
  async logout({ commit }) {
    try {
      await signOut();
      commit('SET_TOKEN', '');
      removeToken();
      return Promise.resolve();
    } catch (error) {
      return Promise.reject(error);
    }
  },
  async getAnnouncements({ commit }) {
    try {
      const data = await announcements();
      commit('SET_ANNOUNCEMENTS', data);
      return Promise.resolve(data);
    } catch (error) {
      return Promise.reject(error);
    }
  },
  async getGroups({ commit }) {
    try {
      const data = await getGroups();
      commit('SET_GROUPS', data.data);
      return Promise.resolve(data.data);
    } catch (error) {
      return Promise.reject(error);
    }
  },
  async changeEmail(_, payload) {
    try {
      await changeEmail(payload);
      return Promise.resolve();
    } catch (error) {
      return Promise.reject(error);
    }
  },
  async forgotPassword(_, payload) {
    try {
      await forgotPassword(payload);
      return Promise.resolve();
    } catch (error) {
      return Promise.reject(error);
    }
  },
  async cofirmToken(_, payload) {
    try {
      await conformTokenForgotPwd(payload);
      return Promise.resolve();
    } catch (error) {
      return Promise.reject(error);
    }
  },
  async resetPassword(_, payload) {
    try {
      await completeNewPassword(payload);
      return Promise.resolve();
    } catch (error) {
      return Promise.reject(error);
    }
  },
  resetToken({ commit }) {
    return new Promise(resolve => {
      commit('SET_TOKEN', '');
      removeToken();
      resolve();
    });
  },
};

export default {
  namespaced: true,
  state,
  mutations,
  actions,
};
