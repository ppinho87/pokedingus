# Stage 1: Build the React application
FROM node:22-alpine AS builder
WORKDIR /app

# Copy lock files and install dependencies
COPY package*.json ./
RUN npm install

# Copy the rest of the application code
COPY . .

# Build the application (Generates 'dist' for Vite or 'build' for CRA)
RUN npm run build

# Stage 2: Serve the application using Nginx
FROM nginx:1.27-alpine

# Copy the build output to Nginx's default public directory
COPY --from=builder /app/build /usr/share/nginx/html

# Configure Nginx to listen on port 8080
RUN sed -i 's/listen\(.*\)80;/listen 8080;/g' /etc/nginx/conf.d/default.conf

EXPOSE 8080

CMD ["nginx", "-g", "daemon off;"]