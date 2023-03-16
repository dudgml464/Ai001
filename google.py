from selenium import webdriver  # 웹수집 자동화를 위한 크롬 드라이버 호출
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
import time, urllib.request
from webdriver_manager.chrome import ChromeDriverManager
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options


# 브라우저 꺼짐 방지 옵션
chrome_options = Options()
chrome_options.add_experimental_option("detach", True)
# 불필요한 에러 메시지 삭제
chrome_options.add_experimental_option("excludeSwitches", ["enable-logging"])
# 크롬 드라이버 최신 버전 설정
service = Service(executable_path=ChromeDriverManager().install())


driver = webdriver.Chrome(service=service, options=chrome_options)  # 크롬드라이버 위치 (크롬버전확인)
driver.get("https://www.google.co.kr/imghp?hl=ko&tab=wi&authuser=0&ogbl") # 웹페이지 해당 주소 이동
elem = driver.find_element(By.NAME, "q")
elem.send_keys("빨간 머리카락")
elem.send_keys(Keys.RETURN)

SCROLL_PAUSE_TIME = 1
# 스크롤 높이 가져오기
last_height = driver.execute_script("return document.body.scrollHeight")
while True:
    # 아래로 스크롤
    driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
    # 페이지 로드 대기
    time.sleep(SCROLL_PAUSE_TIME)
    # 새 스크롤 높이를 계산하고 마지막 스크롤 높이와 비교
    new_height = driver.execute_script("return document.body.scrollHeight")
    if new_height == last_height:
        try:
            driver.find_element(By.CSS_SELECTOR,'.mye4qd').click()
        except:
            break
    last_height = new_height

images = driver.find_elements(By.CSS_SELECTOR,'.rg_i.Q4LuWd')
count = 1
for image in images:
    try:
        image.click()
        time.sleep(0.5)
        imgUrl =  driver.find_element(By.XPATH,'//*[@id="Sva75c"]/div[2]/div/div[2]/div[2]/div[2]/c-wiz/div/div[1]/div[2]/div[2]/div/a/img').get_attribute("src")
        opener=urllib.request.build_opener()
        opener.addheaders=[('User-Agent','Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1941.0 Safari/537.36')]
        urllib.request.install_opener(opener)
        urllib.request.urlretrieve(imgUrl, F'C:/open/{str(count)}.jpg')
        count = count + 1
    except:
        pass

driver.close()