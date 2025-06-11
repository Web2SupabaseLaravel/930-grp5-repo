

import axios from 'axios';


const API_URL = 'http://localhost:8000/api/reviews';


export const getReviews = () => {
  return axios.get(API_URL);
};


export const addReview = (reviewData) => {
  return axios.post(API_URL, reviewData);
};

export const updateReview = (id, reviewData) => {
  return axios.put(`${API_URL}/${id}`, reviewData);
};


export const deleteReview = (id) => {
  return axios.delete(`${API_URL}/${id}`);
};