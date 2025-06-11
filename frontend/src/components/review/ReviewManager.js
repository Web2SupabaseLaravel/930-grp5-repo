

import React, { useState, useEffect } from 'react';
import {
  getReviews,
  addReview,
  updateReview,
  deleteReview
} from '../../api/reviewApi';

function ReviewManager() {
  const [reviews, setReviews] = useState([]);
  const [form, setForm] = useState({
    user_id: '',
    course_id: '',
    rating: '',
    comment: ''
  });
  const [editingId, setEditingId] = useState(null);

  const loadReviews = () => {
    getReviews()
      .then(res => {
       
      })
      .catch(err => {
          console.error('Error fetching reviews:', err);
          if (err.response) {
              console.error('API Error Response for GET:', err.response.data);
              alert(`فشل في جلب المراجعات: ${err.response.data.message || 'خطأ غير معروف'}`);
          } else {
              alert(`فشل في جلب المراجعات: ${err.message}`);
          }
      });
  };

  useEffect(() => {
    loadReviews();
  }, []);

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = () => {
    const submitForm = {
        ...form,
        rating: parseInt(form.rating)
    };

    if (editingId) {
      updateReview(editingId, submitForm)
        .then(() => {
          setForm({ user_id: '', course_id: '', rating: '', comment: '' });
          setEditingId(null);
          loadReviews();
          alert('تم تحديث التقييم بنجاح!');
        })
        .catch(err => {
            console.error('Error updating review:', err.response ? err.response.data : err.message);
            if (err.response && err.response.data && err.response.data.errors) {
                const validationErrors = Object.values(err.response.data.errors).flat().join('\n');
                alert(`فشل في تحديث التقييم:\n${validationErrors}`);
            } else {
                alert('فشل في تحديث التقييم: ' + (err.response?.data?.message || err.message));
            }
        });
    } else {
      addReview(submitForm)
        .then(() => {
          setForm({ user_id: '', course_id: '', rating: '', comment: '' });
          loadReviews();
          alert('تم إضافة التقييم بنجاح!');
        })
        .catch(err => {
            console.error('Error adding review:', err.response ? err.response.data : err.message);
            if (err.response && err.response.data && err.response.data.errors) {
                const validationErrors = Object.values(err.response.data.errors).flat().join('\n');
                alert(`فشل في إضافة التقييم:\n${validationErrors}`);
            } else {
                alert('فشل في إضافة التقييم: ' + (err.response?.data?.message || err.message));
            }
        });
    }
  };

  const handleEdit = (review) => {
    setForm({
      user_id: review.user_id,
      course_id: review.course_id,
      rating: review.rating,
      comment: review.comment
    });
    setEditingId(review.id);
  };

  const handleDelete = (id) => {
    if (window.confirm('هل أنت متأكد من حذف هذا التقييم؟')) {
      deleteReview(id)
        .then(() => {
            loadReviews();
            alert('تم حذف التقييم بنجاح!');
        })
        .catch(err => {
            console.error('Error deleting review:', err.response ? err.response.data : err.message);
            alert('فشل في حذف التقييم: ' + (err.response?.data?.message || err.message));
        });
    }
  };

  return (
    <div className="container mt-4">
      <h2 className="mb-3">إدارة المراجعات</h2>

      <div className="mb-3">
        <input
          className="form-control mb-2"
          name="user_id"
          placeholder="User ID"
          value={form.user_id}
          onChange={handleChange}
        />
        <input
          className="form-control mb-2"
          name="course_id"
          placeholder="Course ID"
          value={form.course_id}
          onChange={handleChange}
        />
        <input
          className="form-control mb-2"
          name="rating"
          type="number"
          placeholder="Rating (1-5)"
          value={form.rating}
          onChange={handleChange}
        />
        <input
          className="form-control mb-2"
          name="comment"
          placeholder="Comment"
          value={form.comment}
          onChange={handleChange}
        />
        <button className="btn btn-primary" onClick={handleSubmit}>
          {editingId ? 'تحديث التقييم' : 'إضافة التقييم'}
        </button>
      </div>

      <ul className="list-group">
        {reviews.length === 0 ? (
            <li className="list-group-item">لا توجد مراجعات حالياً.</li>
        ) : (
            reviews.map(review => (
                <li
                    key={review.id}
                    className="list-group-item d-flex justify-content-between align-items-center"
                >
                    <div>
                        <strong>المستخدم:</strong> {review.user_id} |{' '}
                        <strong>الدورة:</strong> {review.course_id} |{' '}
                        <strong>التقييم:</strong> {review.rating} |{' '}
                        <strong>تعليق:</strong> {review.comment}
                    </div>
                    <div>
                        <button
                            className="btn btn-sm btn-warning me-2"
                            onClick={() => handleEdit(review)}
                        >
                            ✏ تعديل
                        </button>
                        <button
                            className="btn btn-sm btn-danger"
                            onClick={() => handleDelete(review.id)}
                        >
                            🗑 حذف
                        </button>
                    </div>
                </li>
            ))
        )}
      </ul>
    </div>
  );
}

export default ReviewManager;