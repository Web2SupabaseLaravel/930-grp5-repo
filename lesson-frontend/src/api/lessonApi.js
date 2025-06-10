import axios from 'axios';

const API_URL = 'http://127.0.0.1:8000/api/lessons'; // أو أي endpoint حسب Laravel



export const getLessons = () => axios.get(API_URL);
export const addLesson = (data) => axios.post(API_URL, data);
export const deleteLesson = (id) => axios.delete(`${API_URL}/${id}`);
export const getLessonById = (id) => axios.get(`${API_URL}/${id}`);

// 🔵 تحديث بيانات الدرس
export const updateLesson = (id, data) => axios.put(`${API_URL}/${id}`, data);
