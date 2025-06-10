import React, { useState, useEffect } from 'react'; 
import { getLessons, deleteLesson } from '../../api/lessonApi';
import { Link } from 'react-router-dom';

function LessonManager() {
  const [lessons, setLessons] = useState([]);

  const loadLessons = () => {
    getLessons()
      .then(response => {
        if (Array.isArray(response.data)) {
          setLessons(response.data);
        } else if (Array.isArray(response.data.data)) {
          setLessons(response.data.data);
        } else {
          console.warn('Unexpected API response format');
          setLessons([]);
        }
      })
      .catch(error => {
        console.error('Error fetching lessons:', error);
        setLessons([]);
      });
  };

  useEffect(() => {
    loadLessons();
  }, []);

  const handleDelete = (id) => {
    const confirmed = window.confirm('هل أنت متأكد أنك تريد حذف هذا الدرس؟');
    if (confirmed) {
      deleteLesson(id)
        .then(() => loadLessons())
        .catch(err => console.error('Error deleting lesson:', err));
    }
  };

  return (
    <div style={{ padding: '20px' }}>
      <h2>📚 Lessons</h2>

      <div style={{ marginBottom: '15px' }}>
        <Link to="/lessons/add">
          <button style={{ padding: '8px 16px', fontSize: '14px' }}>➕ إضافة درس جديد</button>
        </Link>
      </div>

      {Array.isArray(lessons) && lessons.length > 0 ? (
        <ul>
     {lessons.map((lesson) => (
  <li key={lesson.id} style={{ marginBottom: '20px', border: '1px solid #ccc', padding: '10px', borderRadius: '8px' }}>
    <p><strong>📘 العنوان:</strong> {lesson.title}</p>
    <p><strong>📂 نوع المحتوى:</strong> {lesson.content_type}</p>
    <p><strong>🔗 رابط المحتوى:</strong> <a href={lesson.content_url} target="_blank" rel="noopener noreferrer">{lesson.content_url}</a></p>
    <p><strong>📌 الترتيب:</strong> {lesson.order}</p>
    <p><strong>🎓 معرف الدورة:</strong> {lesson.course_id}</p>

    <Link to={`/lessons/edit/${lesson.id}`}>
      <button style={{ marginRight: '10px' }}>✏️ تعديل</button>
    </Link>
    <button
      onClick={() => handleDelete(lesson.id)}
      style={{ color: 'red' }}
    >
      🗑 حذف
    </button>
  </li>
))}

        </ul>
      ) : (
        <p>لا يوجد دروس حالياً.</p>
      )}
    </div>
  );
}

export default LessonManager;
