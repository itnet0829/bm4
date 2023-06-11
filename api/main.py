from fastapi import FastAPI
from pydantic import BaseModel
from starlette.middleware.cors import CORSMiddleware
import uvicorn

# read
app = FastAPI()

origins=[
    "http://localhost:3000",
    "http://localhost:3600",
    "http://localhost"
]

app.add_middleware(
    CORSMiddleware,
    allow_origins=origins,
    allow_credentials=True,   # 追記により追加
    allow_methods=["*"],      # 追記により追加
    allow_headers=["*"]       # 追記により追加
)

class APIModel(BaseModel):
    api: str

@app.get("/")
async def root():
    return {"version":"0.0.1","description":"Hello World."}

if __name__ == "__main__":
    uvicorn.run(app, host="0.0.0.0", port=8000)