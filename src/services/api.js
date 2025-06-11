import axios from 'axios';

const api = axios.create({
    baseURL: 'http://localhost:8000', // Laravel default port
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },
    withCredentials: true // Important for Laravel Sanctum authentication
});

export const courseService = {
    // Get all courses
    getCourses: () => api.get('/courses'),
    
    // Create payment for a course
    createPayment: (courseId, amount) => api.post('/payments', {
        course_id: courseId,
        amount: amount
    }),
    
    // Get payment status
    getPaymentStatus: (paymentId) => api.get(`/payments/${paymentId}`),
};

export default api;
