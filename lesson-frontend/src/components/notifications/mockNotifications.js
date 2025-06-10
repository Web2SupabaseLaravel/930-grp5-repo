const mockNotifications = [
  {
    id: 1,
    message: "💡 Reminder: Don’t forget to complete your course \"Programming Basics\". You’ve only finished 40% so far.",
    type: "reminder",
    isRead: false,
    timeAgo: "1d"
  },
  {
    id: 2,
    message: "🎉 Congratulations! You’ve successfully enrolled in \"UI Design Fundamentals\". Start learning now!",
    type: "enroll",
    isRead: false,
    timeAgo: "3h"
  },
  {
    id: 3,
    message: "📅 Don’t miss out! A live session for \"Data Analysis\" is scheduled on Monday at 7 PM.",
    type: "event",
    isRead: true,
    timeAgo: "22h"
  },
  {
    id: 4,
    message: "🏆 Well done! You’ve passed the quiz for Unit 2 in \"Artificial Intelligence\".",
    type: "quiz",
    isRead: false,
    timeAgo: "2m"
  }
];

export default mockNotifications;
