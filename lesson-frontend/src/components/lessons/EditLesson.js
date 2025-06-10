import React, { useState, useEffect } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { getLessonById, updateLesson } from '../../api/lessonApi';

function EditLesson() {
  const { id } = useParams(); // جلب ID من الرابط
  const navigate = useNavigate();
  const [form, setForm] = useState({
    title: '',
    content_type: '',
    content_url: '',
    order: '',
    course_id: ''
  });

  // جلب بيانات الدرس عند تحميل الصفحة
  useEffect(() => {
    getLessonById(id)
      .then(response => {
        setForm(response.data); // ملء النموذج بالبيانات القديمة
      })
      .catch(err => {
        console.error('حدث خطأ أثناء جلب بيانات الدرس:', err);
      });
  }, [id]);

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    console.log('بيانات التحديث:', form); // لفحص البيانات قبل الإرسال

    updateLesson(id, form)
      .then(() => navigate('/lessons')) // إعادة التوجيه بعد التحديث
      .catch(err => console.error('حدث خطأ أثناء تحديث الدرس:', err));
  };

  return (
    <form onSubmit={handleSubmit} style={{ padding: '20px' }}>
      <h2>✏️ تعديل الدرس</h2>

      <input
        name="title"
        placeholder="العنوان"
        value={form.title}
        onChange={handleChange}
        required
      /><br />

      {/* قائمة محتوى بأنواع محددة فقط */}
      <select
        name="content_type"
        value={form.content_type}
        onChange={handleChange}
        required
      >
       <option value="">اختر نوع المحتوى</option>
  <option value="Text">📄 Text</option>
  <option value="Video">📹 Video</option>
  <option value="File">📁 File</option>
      </select><br />

      <input
        name="content_url"
        placeholder="رابط المحتوى"
        value={form.content_url}
        onChange={handleChange}
        required
      /><br />

      <input
        name="order"
        placeholder="الترتيب"
        value={form.order}
        onChange={handleChange}
        required
      /><br />

      <input
        name="course_id"
        placeholder="Course ID"
        value={form.course_id}
        onChange={handleChange}
        required
      /><br />

      <button type="submit">💾 حفظ التعديلات</button>
    </form>
  );
}

export default EditLesson;
