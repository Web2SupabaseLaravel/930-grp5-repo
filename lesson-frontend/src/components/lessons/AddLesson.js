import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { addLesson } from '../../api/lessonApi';

function AddLesson() {
  const navigate = useNavigate();
  const [form, setForm] = useState({
    title: '',
    content_type: '',
    content_url: '',
    order: '',
    course_id: ''
  });

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    addLesson(form)
      .then(() => {
        navigate('/lessons'); // بعد الإضافة نرجع لقائمة الدروس
      })
      .catch(err => console.error('Error adding lesson:', err));
  };

  return (
    <form onSubmit={handleSubmit} style={{ padding: '20px' }}>
      <h2>Add Lesson</h2>
      <input name="title" placeholder="Title" value={form.title} onChange={handleChange} required /><br />
      <input name="content_type" placeholder="Content Type" value={form.content_type} onChange={handleChange} required /><br />
      <input name="content_url" placeholder="Content URL" value={form.content_url} onChange={handleChange} required /><br />
      <input name="order" placeholder="Order" value={form.order} onChange={handleChange} required /><br />
      <input name="course_id" placeholder="Course ID" value={form.course_id} onChange={handleChange} required /><br />
      <button type="submit">Submit</button>
    </form>
  );
}

export default AddLesson;
